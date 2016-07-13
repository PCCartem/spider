<?php
namespace Acme\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class GreetCommand extends Command
{
    public $db;
    const DIR = "c:/OpenServer/domains/spider.loc/files/";

    public function __construct()
    {
        $this->db = new \Database();
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('spider:new-task')
            ->setDescription('Greet someone')
            ->addArgument(
                'pattern',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $pattern = $input->getArgument('pattern');
        //Добавление задачи в базу
        //Ходим по папке из задачи и добавляем пути к файлам в базу
        $this->make($pattern);
        $text = "All ok";
        $output->writeln($text);
    }

    public function make($pattern)
    {
        $taskId = $this->db->addTask($pattern);
        $this->findFiles($pattern, $taskId);
    }

    public function findFiles($pattern, $taskId)
    {
        $pattern = self::DIR.$pattern;
        foreach (glob($pattern) as $file) {
            $fileId = $this->db->addFile($file, $taskId);
            if(unlink($file)){
                $this->db->fileWasDelete($fileId);
            }
        }
    }
}