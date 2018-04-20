protected $entityManager;
 
/**
 * {@inheritdoc}
 */
public function __construct(EntityManagerInterface $entityManager) {
  $this->entityManager = $entityManager;
}
  
/**
 * {@inheritdoc}
 */
public static function create(ContainerInterface $container) {
  return new static(
    $container->get('entity.manager')
  );
}
  
/**
 * Return a list of nodes that are published.
 */
protected function example() {
  // We get the node storage object.
  $node_storage = $this->entityManager->getStorage('node');
   
  // We use the load function to load a single node object.
  $nid = 1;
  $node = $node_storage->load($nid);
 
  // We load a revision
  $revision_id = 1;
  $node = $node_storage->loadRevision($revision_id);
 
  // We use the loadMultiple function to load an array of node objects keyed by node ID.
  $nids = [1,2,3,4];
  $nodes = $node_storage->loadMultiple($nids);
 
  // We will discuss this in future lessons, but you can get the value of simple fields using ->get('field_name')->value.
  return [
    '#markup' => $node->get('title')->value,
  ];
}