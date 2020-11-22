<?php
return array(
    'nodes' => array (
        'available' => array (
            'VINGC' => array (
                'label' => 'Git Commit',
                'label_pl' => 'Git Commits',
                'entity' => 'Kofus\Versioning\Entity\CommitEntity',
                'controllers' => array(
                    'Kofus\Versioning\Controller\Commit'
                )
            ),
            'VINGR' => array (
                'label' => 'Release',
                'label_pl' => 'Releases',
                'entity' => 'Kofus\Versioning\Entity\ReleaseEntity',
                'controllers' => array(
                    'Kofus\Versioning\Controller\Release'
                )
            ),
            
        )
    )
);
