<?php

namespace App\Services;


use App\Services\DiscountService;
use App\Services\StripePaymentService;
use App\Patterns\Discounts\TwentyPercentDiscount;
use App\Repositories\Contracts\StockRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;

class OrderProcessingService
{

    protected $productRepository, $stockRepository, $discountService, $stripePaymentService;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        StockRepositoryInterface $stockRepository,
        StripePaymentService $stripePaymentService
    )
    {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
        $this->stripePaymentService = $stripePaymentService;
    }
    public function execute($product_id)
    {
        $product = $this->productRepository->getById($product_id);

        $stock = $this->stockRepository->forProduct($product_id);

        $this->stockRepository->checkAvailibility($stock);

        // $discountService = new DiscountService(new TwentyPercentDiscount);
        $total = DiscountService::make(new TwentyPercentDiscount)->with($product)->apply();

        $paymentSuccessMessage = $this->stripePaymentService->process($total);

        $this->stockRepository->record($product_id);

        return [
            'payment_message' => $paymentSuccessMessage,
            'discounted_price' => $total,
            'original_price'  => $product->price,
            'message' => 'Thank you, your order is being processed'
        ];
    }
}
