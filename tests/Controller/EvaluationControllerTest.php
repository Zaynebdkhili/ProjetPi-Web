<?php

namespace App\Test\Controller;

use App\Entity\Evaluation;
use App\Repository\EvaluationRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EvaluationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EvaluationRepository $repository;
    private string $path = '/evaluation/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Evaluation::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Evaluation index');

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
            'evaluation[valeur1]' => 'Testing',
            'evaluation[valeur2]' => 'Testing',
            'evaluation[echange]' => 'Testing',
        ]);

        self::assertResponseRedirects('/evaluation/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Evaluation();
        $fixture->setValeur1('My Title');
        $fixture->setValeur2('My Title');
        $fixture->setEchange('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Evaluation');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Evaluation();
        $fixture->setValeur1('My Title');
        $fixture->setValeur2('My Title');
        $fixture->setEchange('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'evaluation[valeur1]' => 'Something New',
            'evaluation[valeur2]' => 'Something New',
            'evaluation[echange]' => 'Something New',
        ]);

        self::assertResponseRedirects('/evaluation/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getValeur1());
        self::assertSame('Something New', $fixture[0]->getValeur2());
        self::assertSame('Something New', $fixture[0]->getEchange());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Evaluation();
        $fixture->setValeur1('My Title');
        $fixture->setValeur2('My Title');
        $fixture->setEchange('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/evaluation/');
    }
}
