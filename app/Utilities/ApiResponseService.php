<?php


namespace App\Utilities;

use Illuminate\Mail\Mailables\Content;

class ApiResponseService
{
    /**
     *  Main Success Reponse Functions
     *  @param Array $data
     *  @param ?string $msg
     *  @param int $code
     */

    public static function successResponse($data = [], $msg = null, $code = 200)
    {
        return response()->json(
            [
                'message'   => $msg ?? trans('success'),
                'success'   => true,
                'data'      => $data
            ],
            $code
        );
    }

    /**
     *  Main Error Reponse Functions
     *  @param ?string $msg
     *  @param int $code
     *  @param ?Array $data
     */
    public static function errorResponse($msg = null, $code = 400, $data = null)
    {
        return response()->json(
            [
                'message'   => $msg,
                'success'   => false,
                'errors'    => $data ?? [$msg ?? trans('wrong')]
            ],
            $code
        );
    }

    /**
     *  File Reponse
     *  @param mixed $file
     *  @param string $mimeType
     *  @param string $fileName
     *  @param int $code
     *  @param ?Array $data
     */
    public static function fileResponse($file, $mimeType, $fileName, $code = 200)
    {
        return response(
            content: $file,
            status: $code,
            headers: [
                'Content-Type' => $mimeType,
                'Content-Disposition' => "attachment; filename=\"$fileName\"",
            ]
        );
    }

    /*****************************************************************************************/

    public static function validateResponse($errors, $code = 422)
    {
        return static::errorResponse(
            msg: trans('validation_error'),
            code: $code,
            data: $errors->all(),
        );
    }

    public static function successMsgResponse($msg = null, $code = 200)
    {
        return static::successResponse(
            msg: $msg,
            code: $code
        );
    }

    public static function deletedResponse($msg = null, $code = 200)
    {
        return static::successResponse(
            msg: $msg ?? trans('deleted'),
            code: $code
        );
    }

    public static function notFoundResponse($msg = null, $code = 404)
    {
        return static::errorResponse(
            $msg ?? trans('not_found'),
            code: $code
        );
    }

    public static function unauthorizedResponse($msg = null, $code = 401)
    {
        return static::errorResponse(
            $msg ?? trans('unauthorized'),
            code: $code
        );
    }

    public static function errorMsgResponse($msg = null, $code = 400)
    {
        return static::errorResponse(
            msg: $msg,
            code: $code
        );
    }
}