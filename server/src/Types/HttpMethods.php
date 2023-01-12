<?php

namespace App\Types;

enum HttpMethods: string
{
    case GET = "GET";
    case POST = "POST";
    case PUT = "PUT";
    case PATCH = "PATCH";
    case DELETE = "DELETE";
    case OPTIONS = "OPTIONS";
}
