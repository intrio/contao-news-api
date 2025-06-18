<?php

declare(strict_types=1);

namespace Intermediaio\ContaoNewsApi\Controller;

use Contao\CoreBundle\Framework\ContaoFramework;
use Contao\NewsModel;
use Contao\System;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsApiController
{
    private ContaoFramework $framework;

    public function __construct(ContaoFramework $framework)
    {
        $this->framework = $framework;
    }

    #[Route('/api/news', name: 'news_api_create', methods: ['POST'])]
    public function __invoke(Request $request): Response
    {
        $this->framework->initialize();

        $postData = json_decode($request->getContent(), true);

        if (!is_array($postData) || empty($postData['title']) || empty($postData['text'])) {
            return new JsonResponse(['error' => 'Missing required fields.'], Response::HTTP_BAD_REQUEST);
        }

        // Hole Einstellungen aus tl_settings
        $newsArchiveId = (int) System::getContainer()->get('contao.parameters')->get('newsapi_newsArchive') ?? 0;
        $publishDefault = (bool) System::getContainer()->get('contao.parameters')->get('newsapi_publishByDefault');
        $expectedApiKey = (string) System::getContainer()->get('contao.parameters')->get('newsapi_apiKey');

        // Vergleiche API-Key aus Request mit gespeichertem Key
        $providedApiKey = $postData['api_key'] ?? '';
        if ($providedApiKey !== $expectedApiKey) {
            return new JsonResponse(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        // Beitrag erstellen
        $newsModel = new NewsModel();
        $newsModel->pid = $newsArchiveId;
        $newsModel->tstamp = time();
        $newsModel->headline = $postData['title'];
        $newsModel->text = $postData['text'];
        $newsModel->published = $publishDefault ? '1' : '';
        $newsModel->date = time();
        $newsModel->time = time();
        $newsModel->start = 0;
        $newsModel->stop = 0;

        $newsModel->save();

        return new JsonResponse(['success' => true, 'id' => $newsModel->id]);
    }
}
