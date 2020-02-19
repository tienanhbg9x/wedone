<?php
/**
 * Created by PhpStorm.
 * User: minhngoc
 * Date: 21/10/2019
 * Time: 14:22
 */


namespace App\Http\Controllers\V1;

use Laravel\Lumen\Routing\Controller as BaseController;

use Illuminate\Http\Request;

//*     @OA\Server(
// *         url="http://localhost:8080",
// *         description="API server",
// *     ),


/**
 * @OA\Server(url=API_HOST)
 */

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Swagger Lumen",
 *         description="API Swagger Lumen thể hiện tính năng của Swagger 3 - Lumen 5.6",
 *         termsOfService="http://swagger.io/terms/",
 *         @OA\Contact(name="Swagger API Team"),
 *         @OA\License(name="Huỳnh Mạnh Dần")
 *     ),
 * )
 */

class Controller extends BaseController
{
    public $page = 1;
    public $fields = '*';
    public $where = null;
    public $limit = 30;
    public $offset = 0;
    public $where_in = null;

    function __construct(Request $request)
    {
        if ($request->page) {
            $page = (int)$request->page;
            if ($page < 1 || $page > 100000) {
                $this->page = 1;
            } else {
                $this->page = $page;
            }
            $this->page = (int)$request->page;
        }
        if ($request->fields) $this->fields = $request->fields;
        if ($request->where) $this->where = $request->where;
        if ($request->limit) {
            $limit = (int)$request->limit;
            if ($limit < 1 || $limit > 100) {
                $this->limit = 30;
            } else {
                $this->limit = (int)$request->limit;
            }
        }
        if ($request->where_in) $this->where_in= $request->where_in;

        $this->offset = $this->page*$this->limit - $this->limit;

    }

    function createResponse($data, $status_code = 200, $header = [])
    {
        $response = ['status' => $status_code, 'data' => $data];
        return response($response, $status_code, $header);
    }

}
