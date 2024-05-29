<?php

namespace App\Api\V1\Http\Controllers\Area;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Repositories\Area\AreaRepositoryInterface;


/**
 * @group Chuyên mục
 */
class AreaController extends Controller
{
    public function __construct(
        AreaRepositoryInterface $areaRepository
    )
    {
        $this->repository = $areaRepository;

    }

    /**
     * Danh sách chuyên mục
     *
     * Lấy danh sách chuyên mục.
     *
     * @headersParam X-TOKEN-ACCESS string required
     * token để lấy dữ liệu. Example: 132323
     *
     * @response 200 {
     *      "status": 200,
     *      "message": "Thực hiện thành công.",
     *      "data": [
     *          {
     *               "id": 1,
     *               "name": "Khu vực 1",
     *               "status": 1,
     *               "position": 0,
     *           }
     *      ]
     * }
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $areas = $this->repository->getAll();

        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => $areas
        ]);
    }

}
