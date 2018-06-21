<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    /***
     * 上传图片
     *
     * @param  $request
     * @return array
     */
    public function image(Request $request)
    {
        $file = $request->file('file');

        if (! $file->isValid()) {
            return ['status' => false, 'msg' => '上传失败'];
        }

        do {
            $hashName = time().'.'.$file->guessExtension();
            $path = 'up/'.date("Y-m-d", time());
            $fullName = $path.'/'.$hashName;
            $realPath = storage_path('app/public/'.$fullName);
        } while (file_exists($realPath)); // 如果文件存在，重新生成文件名

        $file->storeAs('public/'.$path, $hashName); //存储到本地
        ////图片换成二进制
        //header("Content-type: image/jpeg");
        //$PSize = filesize($realPath);
        //
        //$fileContents = fread(fopen($realPath, "r"), $PSize);
        //$disk = \Storage::disk('qiniu');
        //$ispost = $disk->put('storage/up/'.date("Y-m-d").'/'.$hashName, $fileContents); //上传到七牛云
        //if (! $ispost) {
        //    return json_response(-1, '上传失败');
        //}
        //$disk->getUrl('storage/up/'.date("Y-m-d").'/'.$hashName); //获取下载链接

        return [
            'status' => true,
            'path' => 'storage/'.$path.'/'.$hashName,
        ];
    }
}