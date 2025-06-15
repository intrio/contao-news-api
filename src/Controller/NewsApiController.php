<?php

namespace Intermediaio\ContaoNewsApi\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Contao\NewsModel;
use Contao\NewsArchiveModel;
use Contao\Config;

class NewsApiController
{
    public function create(Request $request): JsonResponse
    {
        $apiKey = $request->headers->get('X-API-KEY');
        if ($apiKey !== 'DEIN-GEHEIMER-KEY') {
            return new JsonResponse(['error'=>'Unauthorized'], 401);
        }

        $data = json_decode($request->getContent(), true);
        if (!$data || empty($data['title']) || empty($data['text'])) {
            return new JsonResponse(['error'=>'Missing title or text'], 400);
        }

        $archiveId = (int) Config::get('newsapi_newsArchive');
        $archive = NewsArchiveModel::findById($archiveId);
        if (!$archive) {
            return new JsonResponse(['error'=>'Configured archive not found'], 500);
        }

        $publishDefault = (bool) Config::get('newsapi_publishByDefault');
        $publish = $data['published'] ?? $publishDefault;

        $news = new NewsModel();
        $news->pid       = $archive->id;
        $news->tstamp    = time();
        $news->title     = $data['title'];
        $news->alias     = $data['alias'] ?? strtolower(preg_replace('/[^a-z0-9]+/','-',$data['title']));
        $news->author    = 1;
        $news->date      = strtotime($data['date'] ?? 'now');
        $news->time      = $news->date;
        $news->published = (bool) $publish;
        $news->text      = $data['text'];
        $news->save();

        return new JsonResponse([
            'success'=>true,
            'id'=>$news->id,
            'published'=>$news->published
        ]);
    }
}
