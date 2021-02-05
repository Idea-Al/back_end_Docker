<?php

namespace App\DataFixtures;

use App\Entity\Complaint;
use App\Entity\Job;
use App\Entity\Learning;
use App\Entity\Level;
use App\Entity\Logbook;
use App\Entity\Message;
use App\Entity\Project;
use App\Entity\ProjectDescription;
use App\Entity\ProjectFav;
use App\Entity\User;
use App\Entity\UserDescription;
use App\Entity\UserReport;
use App\Entity\Realization;
use App\Entity\Rhythm;
use App\Entity\Role;
use App\Entity\Techno;
use App\Entity\UserFav;
use App\Entity\UserFriend;
use App\Service\Slugger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $slugger;
    private $passwordEncoder;

    public function __construct(Slugger $slugger,UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->slugger = $slugger;
        $this->passwordEncoder = $passwordEncoder;

    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $rhythms = [
            [
                'name' => 'fou furieux',
                'description' => 'Qu\'il pleuve, qu\'il neige, qu\'il vente: tu codes !'
            ],
            [
                'name' => 'chill',
                'description' => "Coder c'est cool, je kiff mais les soirées avec les potes et les weekend: c'est sacré"
            ]
        ];

        $roles = ['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPERADMIN'];

        $technos = ['PHP', 'Javascript', 'Html', 'MySQL', 'React', 'Symfony', 'Laravel'];

        $jobs = ['web-designer', 'developpeur', 'sys-admin'];

        $levels = [
            [
                'name' => 'noob',
                'description' => "Je suis la pour prendre de l'XP"
            ],
            [
                'name' => 'apprenti',
                'description' => 'Je maitrîse plusieurs compétences'
            ],
            [
                'name' => 'PGM',
                'description' => "Je suis la pour passer le temps et fracasser du noob"
            ]
        ];


        $rhythmList = [];
        $roleList = [];
        $technoList = [];
        $jobList = [];
        $levelList = [];
        $userList = [];
        $projectList = [];
        $complaintList = [];

        foreach ($rhythms as $rhythmName) {
            $rhythm = new Rhythm();
            $rhythm->setName($rhythmName['name']);
            $rhythm->setDescription($rhythmName['description']);
            $rhythmList[] = $rhythm;
            $manager->persist($rhythm);
        }

        foreach ($levels as $levelName) {
            $level = new Level();
            $level->setName($levelName['name']);
            $level->setDescription($levelName['description']);
            $levelList[] = $level;
            $manager->persist($level);
        }


        foreach ($technos as $technoName) {
            $techno = new Techno();
            $techno->setName($technoName);
            $techno->setLogo($technoName);
            $technoList[] = $techno;
            $manager->persist($techno);
        }

        foreach ($jobs as $jobName) {
            $job = new Job();
            $job->setName($jobName);
            $jobList[] = $job;
            $manager->persist($job);
        }

        for ($i = 0; $i < 4; $i++) {
            $complaint = new Complaint;
            $complaint->setName($faker->sentence(4, true));
            $complaintList[] = $complaint;
            $manager->persist($complaint);
        }

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setPseudo($faker->name);
            $user->setEmail($faker->email);
            $user->setAvatar($faker->word);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'team'
                ));
            $user->setSchool($faker->text);
            $user->setStatus($faker->boolean(50));
            $user->setIsActive($faker->boolean(50));
            $user->setIsBanned($faker->boolean(50));
            $user->setRhythm($rhythmList[mt_rand(0, count($rhythmList) - 1)]);
            $user->setJob($jobList[mt_rand(0, count($jobList) - 1)]);
            //$user->setSlug($this->slugger->slugify($user->getName()));

            $userDescription = new UserDescription;
            $userDescription->setUser($user);
            $userDescription->setPurpose($faker->text);
            $userDescription->setJourney($faker->text);
            $userDescription->setAboutMe($faker->text);

            //add Realization
            for ($j = 0; $j < mt_rand(1, 3); $j++) {

                $user->addRealization(new Realization);
                $user->getRealizations()[$j]->setUser($user);
                $user->getRealizations()[$j]->setName($faker->sentence(5, true));
                $user->getRealizations()[$j]->setDescription($faker->text);
                $user->getRealizations()[$j]->setScreen($faker->sentence(4, true));
                $user->getRealizations()[$j]->setScreen2($faker->sentence(6, true));
                $user->getRealizations()[$j]->setRepoLink($faker->url);
                $user->getRealizations()[$j]->setWebsiteLink($faker->url);
                for ($d = 0; $d < mt_rand(1, 3); $d++) {
                    $user->getRealizations()[$j]->addTechno($technoList[mt_rand(0, count($technoList) - 1)]);
                }
            }
            $userList[] = $user;
            $manager->persist($user);
            if ($faker->boolean(50) == true) {
                $manager->persist($userDescription);
            }
        }

        for ($i = 0; $i < 10; $i++) {
            $project = new Project;
            $name = $project->setName($faker->sentence(4), true);
            $project->setResume($faker->text);
            $project->setMaxParticipant($faker->numberBetween(2, 5));
            $project->setIsModerated($faker->boolean(50));
            $project->setPicture($faker->text);
            $project->setLink($faker->url);
            $project->setIsCompleted($faker->boolean(50));
            $project->setHasOwner($faker->boolean(50));
            $project->setIsFull($faker->boolean(50));
            $project->setSlug($this->slugger->slugify($name->getName()));
            for ($j = 0; $j < mt_rand(1, 3); $j++) {
                // get a random techno
                $techno = $technoList[mt_rand(0, count($technoList) - 1)];
                // check if it's not already added to the project and if not, add it
                if (!$project->getTechnos()->contains($techno)) {
                    $project->addTechno($techno);
                }
            }
            for ($l = 0; $l < mt_rand(1, 3); $l++) {
                // get a random job
                $projectJob = $jobList[mt_rand(0, count($jobList) - 1)];
                // check if it's not already added to the project and if not, add it
                if (!$project->getJobs()->contains($projectJob)) {
                    $project->addJob($projectJob);
                }
            }
                // get a random creator
                $creator = $userList[mt_rand(0, count($userList) - 1)];
                $project->setCreator($creator);
               

            $projectDescription = new ProjectDescription;
            $projectDescription->setPurpose($faker->text);
            $projectDescription->setTarget($faker->text);
            $projectDescription->setLearningSkill($faker->text);
            $projectDescription->setProject($project);

            $projectList[] = $project;
            $manager->persist($project);
            if ($faker->boolean(50) == true) {
                $manager->persist($projectDescription);
            }
        }

        for ($m = 0; $m < 20; $m++) {
            $projectFav = new ProjectFav;
            for ($j = 0; $j < mt_rand(1, 3); $j++) {
                //Get a random user 
                $userProjectFav = $userList[mt_rand(0, count($userList) - 1)];
                //Get a random project
                $projectFavori = $projectList[mt_rand(0, count($projectList) - 1)];

                if (!$projectFav->getUser() == $userProjectFav && !$projectFav->getProject() == $projectFavori) {
                    $projectFav->setUser($userProjectFav);
                    $projectFav->setProject($projectFavori);
                }
            }
            $manager->persist($projectFav);
        }
        
        for ($a = 0; $a < 20; $a++) {
            $userFav = new UserFav;
            $userFav->setUserLike($userList[mt_rand(0, count($userList) - 1)]);
            $userFav->setUserLiked($userList[mt_rand(0, count($userList) - 1)]);

            for ($n = 0; $n < mt_rand(1, 3); $n++) {
                $userLikes = $userList[mt_rand(0, count($userList) - 1)];
                $userLiked = $userList[mt_rand(0, count($userList) - 1)];
                if ($userLikes != $userLiked && !$userFav->getUserLike() == $userLikes && !$userFav->getuserLiked() == $userLiked) {
                    $userFav->setUserLike($userLikes);
                    $userFav->setuserLiked($userLiked);
                }
            }
            $manager->persist($userFav);
        }

        for ($b = 0; $b < 20; $b++) {
            $learning = new Learning;
            for ($n = 0; $n < mt_rand(1, 5); $n++) {
                $learningUser = $userList[mt_rand(0, count($userList) - 1)];
                $userLevel = $levelList[mt_rand(0, count($levelList) - 1)];
                $userTechno = $technoList[mt_rand(0, count($technoList) - 1)];

                if (!$learning->getLevel() == $userLevel && !$learning->getTechno() == $userTechno && !$learning->getUser() == $learningUser) {
                    $learning->setLevel($userLevel);
                    $learning->setTechno($userTechno);
                    $learning->setUser($learningUser);
                }
            }
            $manager->persist($learning);
        }

        for ($c = 0; $c < 30; $c++) {
            $logbook = new LogBook;
            $logbook->setTask($faker->text);
            $logbook->setUser($userList[mt_rand(0, count($userList) - 1)]);
            $logbook->setProject($projectList[mt_rand(0, count($projectList) - 1)]);

            $manager->persist($logbook);
        }

        for ($i = 0; $i < 15; $i++) {   
            $report = new UserReport;
            $reporter = $userList[mt_rand(0, count($userList) - 1)];
            $reportee = $userList[mt_rand(0, count($userList) - 1)];
            $reason = $complaintList[mt_rand(0, count($complaintList) - 1)];
            $reasonCustomize = $complaintList[2];

            if ($reporter != $reportee) {
                $report->setReporter($reporter);
                $report->setReportee($reportee);
                $report->setIsConfirmed($faker->boolean(50));
                $report->setReason($reason);
                $report->setScreen($faker->word);

                if ($report->getReason() == $reasonCustomize) {
                    $report->setCustomReason($faker->text);
                }  
                $manager->persist($report);            
            }
        }
        
        for ($i = 0; $i < 15; $i++) {
            $userFriend = new UserFriend();
            $friendUser =  $userList[mt_rand(0, count($userList) - 1)];
            $friendWithMe = $userList[mt_rand(0, count($userList) - 1)];

            #If the sender of the friend request is different from the receiver 
            if ($friendUser != $friendWithMe) {
                $userFriend->setUser($friendWithMe);
                $userFriend->setFriend($friendUser);
                $isAnswered = $userFriend->setIsAnswered($faker->boolean(50));
                if ($isAnswered == true) {
                    $userFriend->setIsAccepted($faker->boolean(50));
                } else {
                    $userFriend->setIsAccepted(false);
                }
                $manager->persist($userFriend);
            }
        }

        for ($m = 0; $m < 15; $m++ ){
            $message = new Message();            
            $sender = $userList[mt_rand(0, count($userList) - 1)];
            $receiver = $userList[mt_rand(0, count($userList) - 1)];
            $projectSubject = $projectList[mt_rand(0, count($projectList) - 1)];
             #If message sender is different from the receiver
            if($sender != $receiver){
                $message->setText($faker->text);
                $message->setSender($sender);
                $message->setReceiver($receiver);
                $message->setProject($projectSubject);

                $manager->persist($message);
            }
        }     
        $manager->flush();
    }
}
