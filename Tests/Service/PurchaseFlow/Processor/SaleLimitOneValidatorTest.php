<?php

namespace Plugin\SamplePlugin42\Tests\Service\PurchaseFlow\Processor;

use Eccube\Entity\CartItem;
use Eccube\Service\PurchaseFlow\PurchaseContext;
use Eccube\Tests\EccubeTestCase;
use Plugin\SamplePlugin42\Service\PurchaseFlow\Processor\SaleLimitOneValidator;

class SaleLimitOneValidatorTest extends EccubeTestCase
{
    /**
     * @var SaleLimitOneValidator
     */
    protected $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = static::getContainer()->get(SaleLimitOneValidator::class);
    }

    public function test商品は１個しか購入できない()
    {
        $product = $this->createProduct();

        $cartItem = new CartItem();
        $cartItem->setQuantity(2);
        $cartItem->setProductClass($product->getProductClasses()->first());

        $this->validator->execute($cartItem,new PurchaseContext(null, null));

        self::assertEquals(1, $cartItem->getQuantity());
    }
}
