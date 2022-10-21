<?php

namespace App\Services;


use Illuminate\Http\Request;
use App\Services\DiscountService;
use Illuminate\Support\Facades\DB;
use App\Repositories\StockRepository;
use App\Services\StripePaymentService;
use App\Repositories\ProductRepository;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderProcessingService
{

    protected $productRepository, $stockRepository, $discountService, $stripePaymentService;

    public function __construct(
        ProductRepository $productRepository,
        StockRepository $stockRepository,
        DiscountService $discountService,
        StripePaymentService $stripePaymentService
    )
    {
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
        $this->discountService = $discountService;
        $this->stripePaymentService = $stripePaymentService;
    }
    public function execute($product_id)
    {
        $product = $this->productRepository->getById($product_id);

        $stock = $this->stockRepository->forProduct($product_id);

        $this->stockRepository->checkAvailibility($stock);

        $total = $this->discountService->with($product)->applySpecialDiscount();

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
