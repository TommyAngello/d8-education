<?php

namespace Drupal\page_content\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Url;
use Drupal\page_content\Entity\PageContentInterface;

/**
 * Class PageContentController.
 *
 *  Returns responses for Page content routes.
 */
class PageContentController extends ControllerBase implements ContainerInjectionInterface {

  /**
   * Displays a Page content  revision.
   *
   * @param int $page_content_revision
   *   The Page content  revision ID.
   *
   * @return array
   *   An array suitable for drupal_render().
   */
  public function revisionShow($page_content_revision) {
    $page_content = $this->entityManager()->getStorage('page_content')->loadRevision($page_content_revision);
    $view_builder = $this->entityManager()->getViewBuilder('page_content');

    return $view_builder->view($page_content);
  }

  /**
   * Page title callback for a Page content  revision.
   *
   * @param int $page_content_revision
   *   The Page content  revision ID.
   *
   * @return string
   *   The page title.
   */
  public function revisionPageTitle($page_content_revision) {
    $page_content = $this->entityManager()->getStorage('page_content')->loadRevision($page_content_revision);
    return $this->t('Revision of %title from %date', ['%title' => $page_content->label(), '%date' => format_date($page_content->getRevisionCreationTime())]);
  }

  /**
   * Generates an overview table of older revisions of a Page content .
   *
   * @param \Drupal\page_content\Entity\PageContentInterface $page_content
   *   A Page content  object.
   *
   * @return array
   *   An array as expected by drupal_render().
   */
  public function revisionOverview(PageContentInterface $page_content) {
    $account = $this->currentUser();
    $langcode = $page_content->language()->getId();
    $langname = $page_content->language()->getName();
    $languages = $page_content->getTranslationLanguages();
    $has_translations = (count($languages) > 1);
    $page_content_storage = $this->entityManager()->getStorage('page_content');

    $build['#title'] = $has_translations ? $this->t('@langname revisions for %title', ['@langname' => $langname, '%title' => $page_content->label()]) : $this->t('Revisions for %title', ['%title' => $page_content->label()]);
    $header = [$this->t('Revision'), $this->t('Operations')];

    $revert_permission = (($account->hasPermission("revert all page content revisions") || $account->hasPermission('administer page content entities')));
    $delete_permission = (($account->hasPermission("delete all page content revisions") || $account->hasPermission('administer page content entities')));

    $rows = [];

    $vids = $page_content_storage->revisionIds($page_content);

    $latest_revision = TRUE;

    foreach (array_reverse($vids) as $vid) {
      /** @var \Drupal\page_content\PageContentInterface $revision */
      $revision = $page_content_storage->loadRevision($vid);
      // Only show revisions that are affected by the language that is being
      // displayed.
      if ($revision->hasTranslation($langcode) && $revision->getTranslation($langcode)->isRevisionTranslationAffected()) {
        $username = [
          '#theme' => 'username',
          '#account' => $revision->getRevisionUser(),
        ];

        // Use revision link to link to revisions that are not active.
        $date = \Drupal::service('date.formatter')->format($revision->getRevisionCreationTime(), 'short');
        if ($vid != $page_content->getRevisionId()) {
          $link = $this->l($date, new Url('entity.page_content.revision', ['page_content' => $page_content->id(), 'page_content_revision' => $vid]));
        }
        else {
          $link = $page_content->link($date);
        }

        $row = [];
        $column = [
          'data' => [
            '#type' => 'inline_template',
            '#template' => '{% trans %}{{ date }} by {{ username }}{% endtrans %}{% if message %}<p class="revision-log">{{ message }}</p>{% endif %}',
            '#context' => [
              'date' => $link,
              'username' => \Drupal::service('renderer')->renderPlain($username),
              'message' => ['#markup' => $revision->getRevisionLogMessage(), '#allowed_tags' => Xss::getHtmlTagList()],
            ],
          ],
        ];
        $row[] = $column;

        if ($latest_revision) {
          $row[] = [
            'data' => [
              '#prefix' => '<em>',
              '#markup' => $this->t('Current revision'),
              '#suffix' => '</em>',
            ],
          ];
          foreach ($row as &$current) {
            $current['class'] = ['revision-current'];
          }
          $latest_revision = FALSE;
        }
        else {
          $links = [];
          if ($revert_permission) {
            $links['revert'] = [
              'title' => $this->t('Revert'),
              'url' => $has_translations ?
              Url::fromRoute('entity.page_content.translation_revert', ['page_content' => $page_content->id(), 'page_content_revision' => $vid, 'langcode' => $langcode]) :
              Url::fromRoute('entity.page_content.revision_revert', ['page_content' => $page_content->id(), 'page_content_revision' => $vid]),
            ];
          }

          if ($delete_permission) {
            $links['delete'] = [
              'title' => $this->t('Delete'),
              'url' => Url::fromRoute('entity.page_content.revision_delete', ['page_content' => $page_content->id(), 'page_content_revision' => $vid]),
            ];
          }

          $row[] = [
            'data' => [
              '#type' => 'operations',
              '#links' => $links,
            ],
          ];
        }

        $rows[] = $row;
      }
    }

    $build['page_content_revisions_table'] = [
      '#theme' => 'table',
      '#rows' => $rows,
      '#header' => $header,
    ];

    return $build;
  }

}
