<?php
namespace Krokhmal\Soft\Web;

// ����������� ����� Web ������
abstract class WebEngine
{
    // ���������� �������
    //abstract public function executeRequest($http_method, $url_path, $assoc_params);
    abstract public function executeRequest($url_path);
}
