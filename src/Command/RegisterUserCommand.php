<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterUserCommand extends Command
{
    protected static $defaultName = 'RegisterUser';


    public $em;
    public $encoder;

    public function __construct(EntityManagerInterface $em,UserPasswordEncoderInterface $encoder)
    {
        // best practices recommend to call the parent constructor first and
        // then set your own properties. That wouldn't work in this case
        // because configure() needs the properties set in this constructor
        $this->em=$em;
        $this->encoder=$encoder;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->addArgument('username',InputArgument::REQUIRED,'username')
            ->addArgument('email',InputArgument::REQUIRED,'email')
            ->addArgument('password',InputArgument::REQUIRED,'password')
            ->setDescription('Creates a new user.')
            ->setHelp('This command allows you to create a user...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Registration page',
            '=================',
            '',
        ]);


        $user = new User();
        $user->setUsername($input->getArgument('username'));
        $user->setEmail($input->getArgument('email'));
        $user->setPassword($this->encoder->encodePassword($user,$input->getArgument('password')));
        $this->em->persist($user);
        $this->em->flush();
        $output->writeln('username: '.$input->getArgument('username'));
        $output->writeln('email: '.$input->getArgument('email'));
        $output->writeln('password: '.$input->getArgument('password'));
        $output->writeln('User registered successfully.');

        return Command::SUCCESS;
    }


}
