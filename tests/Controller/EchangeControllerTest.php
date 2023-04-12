<?php

namespace App\Test\Controller;

use App\Entity\Echange;
use App\Repository\EchangeRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EchangeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EchangeRepository $repository;
    private string $path = '/echange/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Echange::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Echange index');

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
            'echange[id_echange]' => 'Testing',
            'echange[date_echange]' => 'Testing',
            'echange[statut]' => 'Testing',
            'echange[confirmation]' => 'Testing',
            'echange[user1]' => 'Testing',
            'echange[article]' => 'Testing',
        ]);

        self::assertResponseRedirects('/echange/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Echange();
        $fixture->setId_echange('My Title');
        $fixture->setDate_echange('My Title');
        $fixture->setStatut('My Title');
        $fixture->setConfirmation('My Title');
        $fixture->setUser1('My Title');
        $fixture->setArticle('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Echange');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Echange();
        $fixture->setId_echange('My Title');
        $fixture->setDate_echange('My Title');
        $fixture->setStatut('My Title');
        $fixture->setConfirmation('My Title');
        $fixture->setUser1('My Title');
        $fixture->setArticle('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'echange[id_echange]' => 'Something New',
            'echange[date_echange]' => 'Something New',
            'echange[statut]' => 'Something New',
            'echange[confirmation]' => 'Something New',
            'echange[user1]' => 'Something New',
            'echange[article]' => 'Something New',
        ]);

        self::assertResponseRedirects('/echange/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getId_echange());
        self::assertSame('Something New', $fixture[0]->getDate_echange());
        self::assertSame('Something New', $fixture[0]->getStatut());
        self::assertSame('Something New', $fixture[0]->getConfirmation());
        self::assertSame('Something New', $fixture[0]->getUser1());
        self::assertSame('Something New', $fixture[0]->getArticle());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Echange();
        $fixture->setId_echange('My Title');
        $fixture->setDate_echange('My Title');
        $fixture->setStatut('My Title');
        $fixture->setConfirmation('My Title');
        $fixture->setUser1('My Title');
        $fixture->setArticle('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/echange/');
    }
}
