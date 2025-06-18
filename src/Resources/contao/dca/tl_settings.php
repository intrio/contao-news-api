<?php

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{newsapi_legend},newsapi_newsArchive,newsapi_publishByDefault,newsapi_apiKey';

$GLOBALS['TL_DCA']['tl_settings']['fields']['newsapi_apiKey'] = [
    'label'     => ['API‑Key', 'Authentifizierungsschlüssel für externe API-Zugriffe.'],
    'inputType' => 'text',
    'eval'      => ['maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql'       => "varchar(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['newsapi_newsArchive'] = [
  'label'             => ['News-Archiv (API)', 'Archiv, in das Beiträge per API geschrieben werden.'],
  'inputType'         => 'select',
  'options_callback'  => static function () {
    $options = [];
    $archives = \Contao\NewsArchiveModel::findAll();

    if ($archives !== null) {
        foreach ($archives as $archive) {
            $options[$archive->id] = $archive->title;
        }
    }

    return $options;
},
  'eval'              => ['mandatory'=>true,'chosen'=>true],
  'sql'               => "int(10) unsigned NOT NULL default '0'"
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['newsapi_publishByDefault'] = [
  'label'             => ['API‑Beiträge sofort veröffentlichen', 'Wenn angehakt, werden Beiträge standardmäßig publiziert.'],
  'inputType'         => 'checkbox',
  'eval'              => ['tl_class'=>'clr'],
  'sql'               => "char(1) NOT NULL default ''"
];