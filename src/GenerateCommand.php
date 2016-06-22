<?php

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command {
    public function configure() {
        $this->setName('generate')
            ->setDescription('Gera números randômicos para os sorteios.')
            ->addArgument('type', InputArgument::REQUIRED, 'Tipo do sorteio: quina, mega-sena ou loto-facil.')
            ->addArgument('quantity', InputArgument::OPTIONAL, 'Quantidade de números a gerar.');
    }

    public function execute(InputInterface $input, OutputInterface $output) {
        $undone = true;
        $values = [];
        $games = [
            'quina' => [5, 80],
            'mega-sena' => [6, 60],
            'loto-facil' => [15, 25]
        ];

        $type = $input->getArgument('type');
        if(!in_array($type, array_keys($games))) {
            $output->writeln("<error>Escolha o jogo: quina, mega-sena ou loto-facil.</error>");
            exit(1);
        }

        $quantity = $games[$type][0];
        $total = $games[$type][1];

        if($input->getArgument('quantity') && $input->getArgument('quantity') > $quantity){
            $quantity = $input->getArgument('quantity');
        } else if($input->getArgument('quantity') < $quantity){
            $output->writeln("<comment>Valor informado abaixo do permitido, o padrão ({$quantity}) será mantido.</comment>");
        }

        while($undone) {
            if(count($values) == $quantity) {
                $undone = false;
                break;
            }

            $value = rand(1, $total);
            if(empty($values) || !in_array($value, $values)) {
                $values[] = $value;
            }
        }

        sort($values);

        $result = implode(", ", $values);
        $output->writeln("<info>{$result}</info>");
    }
}
