<?php

namespace App\Api\V1\Http\Controllers\UserDriver;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\UserDriver\UserDriverRequest;
use App\Api\V1\Http\Resources\UserDriver\UserDriverResource;
use App\Api\V1\Repositories\UserDriver\UserDriverRepositoryInterface;
use App\Api\V1\Services\UserDriver\UserDriverServiceInterface;
use Exception;
use Illuminate\Http\JsonResponse;

/**
 * @group driver
 */
class UserDriverController extends Controller
{
    public function __construct(
        UserDriverRepositoryInterface $repository,
        UserDriverServiceInterface    $service
    )
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Tạo Mới Thông Tin Tài Xế
     *
     * Tạo mới thông tin của một tài xế sử dụng dữ liệu được cung cấp qua HTTP POST request.
     *
     * @bodyParam user_id int required ID của người dùng. Phải tồn tại trong bảng `users`.
     * @bodyParam avatar string nullable URL của ảnh đại diện. Phải là một URL hợp lệ.
     * @bodyParam id_card string required Số chứng minh nhân dân. Tối đa 50 ký tự và phải duy nhất trong bảng `user_driver_info`.
     * @bodyParam id_card_front string nullable URL của ảnh mặt trước CMND/CCCD. Phải là một URL hợp lệ.
     * @bodyParam id_card_back string nullable URL của ảnh mặt sau CMND/CCCD. Phải là một URL hợp lệ.
     * @bodyParam license_plate string nullable Biển số xe. Tối đa 255 ký tự.
     * @bodyParam vehicle_company string nullable Tên công ty xe. Tối đa 255 ký tự.
     * @bodyParam vehicle_registration_front string nullable URL của ảnh mặt trước giấy đăng ký xe. Phải là một URL hợp lệ.
     * @bodyParam vehicle_registration_back string nullable URL của ảnh mặt sau giấy đăng ký xe. Phải là một URL hợp lệ.
     * @bodyParam driver_license_front string nullable URL của ảnh mặt trước bằng lái xe. Phải là một URL hợp lệ.
     * @bodyParam driver_license_back string nullable URL của ảnh mặt sau bằng lái xe. Phải là một URL hợp lệ.
     * @bodyParam bank_name string nullable Tên ngân hàng. Tối đa 255 ký tự.
     * @bodyParam bank_account_name string nullable Tên chủ tài khoản ngân hàng. Tối đa 255 ký tự.
     * @bodyParam bank_account_number string nullable Số tài khoản ngân hàng. Tối đa 255 ký tự.
     *
     * @response {
     *      "status": 200,
     *      "message": "Tạo mới thông tin tài xế thành công.",
     *      "data": {...}
     * }
     *
     * @response 400 {
     *      "status": 400,
     *      "message": "Dữ liệu không hợp lệ.",
     *      "errors": {...}
     * }
     *

     */
    public function store(UserDriverRequest $request): JsonResponse
    {
        $driver = $this->service->store($request);

        return response()->json([
            'status' => 200,
            'message' => __('created successfully.'),
            'data' => $driver
        ]);
    }

    /**
     * Cập Nhật Thông Tin Tài Xế
     *
     * Cập nhật thông tin chi tiết của tài xế dựa trên dữ liệu được cung cấp.
     * Yêu cầu này chỉ có thể được thực hiện với dữ liệu đã được xác thực qua `UserDriverRequest`.
     *
     * @bodyParam avatar string nullable URL của ảnh đại diện. Phải là một URL hợp lệ.
     * @bodyParam id_card string required Số chứng minh nhân dân. Tối đa 50 ký tự và phải duy nhất.
     * @bodyParam id_card_front string nullable URL của ảnh mặt trước CMND/CCCD. Phải là một URL hợp lệ.
     * @bodyParam id_card_back string nullable URL của ảnh mặt sau CMND/CCCD. Phải là một URL hợp lệ.
     * @bodyParam license_plate string nullable Biển số xe. Tối đa 255 ký tự.
     * @bodyParam vehicle_company string nullable Tên công ty xe. Tối đa 255 ký tự.
     * @bodyParam vehicle_registration_front string nullable URL của ảnh mặt trước giấy đăng ký xe. Phải là một URL hợp lệ.
     * @bodyParam vehicle_registration_back string nullable URL của ảnh mặt sau giấy đăng ký xe. Phải là một URL hợp lệ.
     * @bodyParam driver_license_front string nullable URL của ảnh mặt trước bằng lái xe. Phải là một URL hợp lệ.
     * @bodyParam driver_license_back string nullable URL của ảnh mặt sau bằng lái xe. Phải là một URL hợp lệ.
     * @bodyParam bank_name string nullable Tên ngân hàng. Tối đa 255 ký tự.
     * @bodyParam bank_account_name string nullable Tên chủ tài khoản ngân hàng. Tối đa 255 ký tự.
     * @bodyParam bank_account_number string nullable Số tài khoản ngân hàng. Tối đa 255 ký tự.
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thông tin tài xế cập nhật thành công.",
     *      "data": {...}
     * }
     *
     * @response 400 {
     *      "status": 400,
     *      "message": "Yêu cầu không hợp lệ hoặc không thể xác thực.",
     *      "errors": {...}
     * }
     *
     *
     * @return JsonResponse Trả về phản hồi JSON với kết quả.
     */
    public function update($id, UserDriverRequest $request): ?JsonResponse
    {

        try {
            $driver = $this->service->update($id, $request);
            if ($driver != null) {
                return response()->json([
                    'status' => 200,
                    'message' => __('Driver updated successfully.'),
                    'data' => $driver
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 404,
                'message' => __('Driver not found.'),
            ]);
        }
        return null;
    }

    /**
     * Hiển Thị Thông Tin Tài Xế
     *
     * Lấy thông tin chi tiết của một tài xế dựa trên ID được cung cấp.
     * Trả về thông tin tài xế bao gồm cả thông tin cá nhân và thông tin liên quan đến phương tiện.
     *
     * @param int $id  ID của tài xế cần lấy thông tin.
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": {
     *          "id": 4,
     *          "user_id": 1,
     *          "avatar": "http://example.com/images/avatar.jpg",
     *      }
     * }
     *
     * @response 404 {
     *      "status": 404,
     *      "message": "Không tìm thấy tài xế."
     * }
     *
     * @return JsonResponse Trả về thông tin tài xế hoặc thông báo lỗi.
     */
    public function show(int $id): JsonResponse
    {
        $driver = $this->service->findById($id);


        if ($driver instanceof JsonResponse) {
            return $driver;
        }

        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => new UserDriverResource($driver)
        ]);
    }


}
