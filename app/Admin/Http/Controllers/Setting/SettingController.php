<?php

namespace App\Admin\Http\Controllers\Setting;

use App\Admin\Http\Controllers\Controller;
use App\Admin\Repositories\Setting\SettingRepositoryInterface;
use App\Enums\Setting\SettingGroup;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(
        SettingRepositoryInterface $repository
    )
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function getView(): array
    {
        return [
            'general' => 'admin.settings.general',
            'system' => 'admin.settings.system',
            'appearance' => 'admin.settings.appearance',

        ];
    }

    public function general(): Factory|View|Application
    {
        $settings = $this->repository->getByGroup([SettingGroup::General]);
        return view($this->view['general'], [
            'settings' => $settings,
            'breadcrums' => $this->crums->add(__('generateSetting'))
        ]);
    }

    public function system(): Factory|View|Application
    {
        $settings = $this->repository->getByGroup([SettingGroup::System]);
        return view($this->view['system'], [
            'settings' => $settings,
            'breadcrums' => $this->crums->add(__('system'))
        ]);
    }

    public function appearance()
    {
        $settings = $this->repository->getByGroup([SettingGroup::Appearance]);
        $notificationSetting = $settings->firstWhere('setting_key', 'notification');

        $notificationPreference = $notificationSetting ? $notificationSetting->plain_value : 0;

        return view($this->view['appearance'], [
            'settings' => $settings,
            'notificationPreference' => $notificationPreference,
            'breadcrums' => $this->crums->add(__('appearance'))
        ]);
    }


    public function update(Request $request): RedirectResponse
    {
        $data = $request->except('_token', '_method');
        $this->repository->updateMultipleRecord($data);
        return back()->with('success', __('notifySuccess'));
    }

    public function updateAppearance(Request $request): RedirectResponse
    {
        $value = $request->input('notification_preference', 0);

        $result = $this->repository->updateByCondition([
            "setting_key" => "notification"
        ], [
            'plain_value' => $value
        ]);

        if ($result) {
            return back()->with('success', __('notifySuccess'));
        }

        return back()->with('error', __('notifyError'));
    }


}
