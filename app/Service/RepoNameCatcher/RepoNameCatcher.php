<?php

namespace Bwyty\ServiceConfigValidator\Service\RepoNameCatcher;

class RepoNameCatcher implements RepoNameCatcherInterface
{
    public function catchRepoName(): string {
        $repoName = getenv('GITHUB_REPOSITORY');

        if($repoName === false) {
            throw new \Exception('Could not get repository name');
        }

        return $repoName;
    }
}
