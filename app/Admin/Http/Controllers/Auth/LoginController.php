<?php

namespace App\Admin\Http\Controllers\Auth;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Http\Requests\Auth\LoginRequest;
use App\Admin\Repositories\Admin\AdminRepositoryInterface;
use App\Traits\NotifiesViaFirebase;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Setting\SettingRepositoryInterface;

class LoginController extends Controller
{
    use NotifiesViaFirebase;

    //
    private $login;
    protected $repoSetting;

    private AdminRepositoryInterface $adminRepository;

    public function __construct(SettingRepositoryInterface $repoSetting,AdminRepositoryInterface $adminRepository)
    {
        parent::__construct();
        $this->repoSetting = $repoSetting;
        $this->adminRepository = $adminRepository;
    }

    public function getView()
    {
        return [
            'index' => 'admin.auth.login'
        ];
    }

    public function index()
    {
        $logo = $this->repoSetting->getValueByKey('site_logo') ?? config('custom.images.logo');
        return view($this->view['index'], compact('logo'));
    }

//    public function login(LoginRequest $request){
//
//        $this->login = $request->validated();
//
//        if($this->resolve()){
//
//            $request->session()->regenerate();
//
//            return redirect()->intended(route('admin.dashboard'))->with('success', __('notifySuccess'));
//
//        }
//        return back()->with('error', __('LoginFail'));
//    }
    /**
     * @throws \Exception
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password']
        ];

        if ($this->resolve($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard('admin')->user();
            if (isset($validated['device_token']) && $user) {
                $this->registerDeviceToTopic($validated['device_token'], 'Notification');
                $this->adminRepository->update($user->id,[
                    'device_token' => $validated['device_token'],
                    'topic' => 'Notification',
                    'device_token_updated_at' => now(),
                ]);
            }
            return redirect()->intended(route('admin.dashboard'))->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('LoginFail'));
    }

    protected function resolve($credentials): bool
    {
        return Auth::guard('admin')->attempt($credentials, true);
    }
}
