<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('vpa:db:trigger')
            ->setDescription('Add trigger for project')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $doctrine = $this->getContainer()->get('doctrine');
      $doctrine->getConnection()->exec('drop trigger if exists DeleteRecordsForDeletedUser;');
/*delimiter //
create trigger DeleteRecordsForDeletedUser
	before delete on `User`
for each ROW
begin
	delete from `Record`
	where `owner`= OLD.`id`;
end
//
delimiter ;'
      );*/
      
      $output->writeln('Added trigger.');
    }
}