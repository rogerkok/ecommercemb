<?php

namespace App\Test\Controller;

use App\Entity\Adresse;
use App\Repository\AdresseRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdresseControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private AdresseRepository $repository;
    private string $path = '/adresse/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Adresse::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Adresse index');

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
            'adresse[nom]' => 'Testing',
            'adresse[nomadr]' => 'Testing',
            'adresse[prenom]' => 'Testing',
            'adresse[entreprise]' => 'Testing',
            'adresse[adresse]' => 'Testing',
            'adresse[bp]' => 'Testing',
            'adresse[ville]' => 'Testing',
            'adresse[pays]' => 'Testing',
            'adresse[phone]' => 'Testing',
            'adresse[client]' => 'Testing',
        ]);

        self::assertResponseRedirects('/adresse/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Adresse();
        $fixture->setNom('My Title');
        $fixture->setNomadr('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEntreprise('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setBp('My Title');
        $fixture->setVille('My Title');
        $fixture->setPays('My Title');
        $fixture->setPhone('My Title');
        $fixture->setClient('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Adresse');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Adresse();
        $fixture->setNom('My Title');
        $fixture->setNomadr('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEntreprise('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setBp('My Title');
        $fixture->setVille('My Title');
        $fixture->setPays('My Title');
        $fixture->setPhone('My Title');
        $fixture->setClient('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'adresse[nom]' => 'Something New',
            'adresse[nomadr]' => 'Something New',
            'adresse[prenom]' => 'Something New',
            'adresse[entreprise]' => 'Something New',
            'adresse[adresse]' => 'Something New',
            'adresse[bp]' => 'Something New',
            'adresse[ville]' => 'Something New',
            'adresse[pays]' => 'Something New',
            'adresse[phone]' => 'Something New',
            'adresse[client]' => 'Something New',
        ]);

        self::assertResponseRedirects('/adresse/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getNomadr());
        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getEntreprise());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getBp());
        self::assertSame('Something New', $fixture[0]->getVille());
        self::assertSame('Something New', $fixture[0]->getPays());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getClient());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Adresse();
        $fixture->setNom('My Title');
        $fixture->setNomadr('My Title');
        $fixture->setPrenom('My Title');
        $fixture->setEntreprise('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setBp('My Title');
        $fixture->setVille('My Title');
        $fixture->setPays('My Title');
        $fixture->setPhone('My Title');
        $fixture->setClient('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/adresse/');
    }
}
