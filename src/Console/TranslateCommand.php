<?php
// todo: Multiple languagas translation
// todo: Handle errors
namespace App\Console;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use App\Translator;


#[AsCommand(name: 'translate:file')]
class TranslateCommand extends Command
{
  protected function configure(): void
  {
    parent::configure();

    $this
    ->setDescription('Translate file into a language or list of languages')
    ->addArgument('filePath',  InputArgument::REQUIRED, 'Path to file to translate')
    ->addOption('from', 'f',  InputOption::VALUE_REQUIRED, 'The language code of source filed.', 'en')
    ->addOption('to', 't',  InputOption::VALUE_REQUIRED, 'A language code or codes to translte to.', 'en');

  }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
      $pathToFile = $input->getArgument('filePath');
      $explodedPath = explode('/', $pathToFile);
      $fileName = end($explodedPath);

      $sourceLang = $input->getOption('from');
      $translateTo = $input->getOption('to');

      $sourceFile = fopen($pathToFile, "r") or die("Unable to read file");
      
      $translatedFile = fopen($fileName . '_' . $translateTo . '.txt', "w") or die("Unable to write file");

      while(!feof($sourceFile)) {
        fwrite($translatedFile, Translator::translate(fgets($sourceFile)));
      }
      fclose($sourceFile);
      fclose($translatedFile);

      return Command::SUCCESS;
    }
}