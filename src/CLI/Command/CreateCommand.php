<?php
namespace FTCBotCore\CLI\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use FTCBotCore\Model\Core\PublicSchema\CommandsModel;
use Symfony\Component\Console\Input\InputArgument;
use PommProject\Foundation\Pomm;
use PommProject\Cli\Command\PommAwareCommand;
use FTCBotCore\CLI\DatabaseAwareTrait;
use Medoo\Medoo;


class CreateCommand extends Command
{
    use DatabaseAwareTrait;
    
    private $db;
    
    public function __construct()
    {
        $this->db = new Medoo([
            'database_type' => 'pgsql',
            'database_name' => 'discord_bot',
            'server' => 'core-db',
            'username' => 'postgres',
            'password' => 'password'
        ]);
        parent::__construct();
    }
    
    protected function configure()
    {
        $this->setName('generate:command', 'core')
            ->setDescription('Generate a bot command.')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the command to be added.')
            ->addArgument('help', InputArgument::REQUIRED, 'Help text to display on Discord.')
            ->setHelp(<<<HELP
Blah
HELP
        );
        parent::configure();
    }

    /**
     * configureOptionals
     *
     * @see PommAwareCommand
     */
    protected function configureOptionals()
    {
        parent::configureOptionals()->addOption(
                'force',
                null,
                InputOption::VALUE_NONE,
                'Force overwriting an existing file.'
            );

        return $this;
    }

    /**
     * execute
     *
     * @see Command
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {

        exit();
        $commandsModel = new CommandsModel;

        $commandsModel->createAndSave(
            [
            'name' => $input->getArgument('name'),
            'help_text' => $input->getArgument('help'),
            ]
        );
//         var_dump($commandsModel->findAll());
//         parent::execute($input, $output);
//         $info = $this->getSession()
//             ->getInspector()
//             ->getSchemas();
        
//         var_dump($input, $output);
//         echo "oooo";
        

//         $session = $this->mustBeModelManagerSession($this->getSession());

//         $this->pathFile = $this->getPathFile($input->getArgument('config-name'), $this->relation, '', '', $input->getOption('psr4'));
//         $this->namespace = $this->getNamespace($input->getArgument('config-name'));

//         $this->updateOutput(
//             $output,
//             (new EntityGenerator(
//                 $session,
//                 $this->schema,
//                 $this->relation,
//                 $this->pathFile,
//                 $this->namespace,
//                 $this->flexible_container
//             ))->generate(new ParameterHolder(['force' => $input->getOption('force')]))
//         );
    }
}
