<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CatTest extends WebTestCase
{
    public function testGetAllCats(): void
    {
        $client = static::createClient();
        // Получение всех кошек
        $content = $this->getAllCats($client);

        $this->assertResponseIsSuccessful();

        // Проверка наличия необходимых данных по каждой кошке
        foreach ($content as $cat) {
            $this->assertArrayHasKey('id', $cat);
            $this->assertArrayHasKey('cat_name', $cat);
            $this->assertArrayHasKey('breed_name', $cat);
        }
    }

    public function getAllCats(KernelBrowser $client): array
    {
        $client->jsonRequest('GET', '/cats');

        return json_decode($client->getResponse()->getContent(), true);
    }

    /**
     * @dataProvider deleteCatDataProvider
     */
    public function testDeleteCat(int $catId): void
    {
        $client = static::createClient();

        // Убеждаемся, что перед проведением удаления удаляемый кот есть в системе
        $allCats = array_column($this->getAllCats($client), 'id');
        $this->assertNotFalse(array_search($catId, $allCats));

        // Производим удаление
        $client->jsonRequest('DELETE', sprintf('/cats/%d', $catId));
        $this->assertResponseIsSuccessful();

        // Убеждаемся, что после проведения удаления удаляемого кота нет в системе
        $allCats = array_column($this->getAllCats($client), 'id');
        $this->assertFalse(array_search($catId, $allCats));
    }

    public function deleteCatDataProvider(): ?\Generator
    {
        yield [
            'catId' => 5,
        ];
        yield [
            'catId' => 2,
        ];
        yield [
            'catId' => 10,
        ];
    }
}
