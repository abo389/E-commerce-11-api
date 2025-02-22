<?php

namespace App\Traits;

trait ApiResponse {

  function success($message, $data, $status = 200) {
    return response()->json([
      "status" => "success",
      "message" => $message,
      "data" => $data
    ], $status);
  }

  function error($message, $status = 500) {
    return response()->json([
      "status" => "error",
      "message" => $message
    ], $status);
  }
}