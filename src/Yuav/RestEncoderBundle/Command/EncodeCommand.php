<?php
namespace Yuav\RestEncoderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Gaufrette\Filesystem;
use Gaufrette\Adapter\Local as LocalAdapter;
use FFMpeg\FFMpeg;
use Yuav\RestEncoderBundle\Entity\Job;
use Alchemy\BinaryDriver\Listeners\DebugListener;
use Yuav\RestEncoderBundle\Entity\Output;
use Alchemy\BinaryDriver\Exception\InvalidArgumentException;
use Yuav\RestEncoderBundle\Encoder\JobEncoder;
use Yuav\RestEncoderBundle\Encoder\InputHandler;
use Yuav\RestEncoderBundle\Encoder\OutputHandler;

class EncodeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
        ->setName('restencoder:encode')
        ->setDescription('Encode output')
        ->addArgument('output', InputArgument::REQUIRED, 'Output id to encode')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $job = $this->getNextJobFromQueue();
        if (false == $job) {
            $output->writeln("No more jobs in queue");
            return;
        }
        $url = $job->getInput();
     
        $jobEncoder = new JobEncoder(new InputHandler(), new OutputHandler());
        $jobEncoder->processJob($job);
      
        $output->writeln("done");
        
       
        
        
        // TODO
//         $progress = $this->getHelperSet()->get('progress');
        
//         $progress->start($output, 50);
//         $i = 0;
//         while ($i++ < 50) {
//             // ... do some work
        
//             // advance the progress bar 1 unit
//             $progress->advance();
//         }
        
//         $progress->finish();
    }
    
    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        $em = $this->getContainer()->get('doctrine')->getManager();
        return $em;
    }
    
    private function uploadOutputFile(Output $output, $outputPathFile)
    {
        $destination = $output->getUrl();
        
        
    }
    

    
    private function getNextJobFromQueue()
    {
        $em = $this->getEntityManager();
        $dql = 'SELECT j FROM \Yuav\RestEncoderBundle\Entity\Job j ORDER BY j.submittedAt ASC';
        $query = $em->createQuery($dql);
        $query->setMaxResults(1);
        $job = $query->getResult();
        return (!$job) ? false : $job;
        
    }
}