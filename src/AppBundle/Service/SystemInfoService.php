<?php

namespace AppBundle\Service;

class SystemInfoService {
    public function returnAll() : array {
        return [
            "disk" => $this->getDiskUsage(),
            "uname" => $this->getUname(),
            "cpu" => $this->getCpu(),
        ];
    }

    public function getDiskUsage() : array {
        $output = explode(" ", exec("df -h / | tail -n1"));
        $tmp = array_filter($output);
        $output = [];
        foreach($tmp as $element) {
            $output[] = $element;
        }
        $output = [
            "name" => $output[0],
            "size" => $output[1],
            "used" => $output[2],
            "free" => $output[3],
            "precentage" => $output[4],
            "mountpoint" => $output[5],
        ];
        return $output;
    }

    public function getUname() : array {
        $uname = [
            "node_name" => exec("uname -n"),
            "kernel_release" => exec("uname -r"),
            "arch" => exec("uname -m"),
        ];
        return $uname;
    }

    public function getCpu() : string {
        $output = exec("lscpu | grep Model | tail -n1");
        $output = explode("                      ", $output);
        return $output[sizeof($output)-1];
    }

}