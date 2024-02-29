<?php

namespace App\Test\Controller;

use App\Entity\InsuranceGuarantee;
use App\Repository\InsuranceGuaranteeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InsuranceGuaranteeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private InsuranceGuaranteeRepository $repository;
    private string $path = '/insurance/guarantee/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(InsuranceGuarantee::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InsuranceGuarantee index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'insurance_guarantee[name]' => 'Testing',
            'insurance_guarantee[description]' => 'Testing',
            'insurance_guarantee[coverage]' => 'Testing',
            'insurance_guarantee[monthlyPrice]' => 'Testing',
            'insurance_guarantee[pack]' => 'Testing',
        ]);

        self::assertResponseRedirects('/insurance/guarantee/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new InsuranceGuarantee();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCoverage('My Title');
        $fixture->setMonthlyPrice('My Title');
        $fixture->setPack('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InsuranceGuarantee');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new InsuranceGuarantee();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCoverage('My Title');
        $fixture->setMonthlyPrice('My Title');
        $fixture->setPack('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'insurance_guarantee[name]' => 'Something New',
            'insurance_guarantee[description]' => 'Something New',
            'insurance_guarantee[coverage]' => 'Something New',
            'insurance_guarantee[monthlyPrice]' => 'Something New',
            'insurance_guarantee[pack]' => 'Something New',
        ]);

        self::assertResponseRedirects('/insurance/guarantee/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getCoverage());
        self::assertSame('Something New', $fixture[0]->getMonthlyPrice());
        self::assertSame('Something New', $fixture[0]->getPack());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new InsuranceGuarantee();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setCoverage('My Title');
        $fixture->setMonthlyPrice('My Title');
        $fixture->setPack('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/insurance/guarantee/');
    }
}
