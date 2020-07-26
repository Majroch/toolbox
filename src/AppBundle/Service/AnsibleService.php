<?php

namespace AppBundle\Service;

use Symfony\Component\HttpKernel\KernelInterface;

class AnsibleService {

    private $tasksDir;
    private $invDir;
    private $vaultPass;

    private $bannedChars;

    public function __construct(KernelInterface $kernel) {
        $this->tasksDir = $kernel->getProjectDir() . "/ansibleTasks";
        $this->invDir = $kernel->getProjectDir() . "/ansibleInventory";
        $this->vaultPass = $kernel->getProjectDir() . "/.vault-pass.txt";

        $this->bannedChars = [
            "/",
            "\\",
            "|",
            "&",
            "+",
            "=",
        ];
    }

    public function getAnsibleTasks() : array {
        $output = [];
        foreach(\glob($this->tasksDir . "/*.yml") as $filename) {
            $output[] = basename($filename);
        }
        foreach(\glob($this->tasksDir . "/*.yaml") as $filename) {
            $output[] = basename($filename);
        }
        return $output;
    }

    public function sanitizeString(string $string) : string {
        return str_replace($this->bannedChars, "", $string);
    }

    public function executeTask(string $task) {
        if(in_array($task, $this->getAnsibleTasks())) {
            exec("screen -dmS ansible-playbook ansible-playbook -i " . $this->invDir . " --vault-password-file " . $this->vaultPass . " " . $this->tasksDir . "/" . $task . " &");
            return True;
        } else return False;
    }
}