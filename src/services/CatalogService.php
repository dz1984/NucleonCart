<?php
namespace NucleonCart\Service;

use NucleonCart\Core\Product;

class CatalogService 
{
  public function findProductById($id = null)
  {
    if (is_null($id)) {
      return null;
    }

    return new Product($id);
  }
}