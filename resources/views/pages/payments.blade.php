@extends('layouts.app')

@section('title', $page->title ?? 'Payments')
@section('description', $page->meta_description ?? $page->subtitle ?? 'Pay your ACRA subscription securely.')

@section('content')
@include('layouts.page-masthead', [
    'eyebrow' => 'Residents',
    'title' => $page->title ?? 'Payments',
    'subtitle' => $page->subtitle ?? 'Pay your ACRA subscription securely through the official Akright City payment portal.',
])

<section class="container-site content-shell payment-layout">
    <div class="card feature-panel payment-info" data-reveal>
        <p class="eyebrow">ACRA Subscriptions</p>
        <h2>Secure online payments</h2>
        <p class="section-sub">Use the official Akright City payment portal to pay your ACRA subscription and related community dues. Your payment is handled on the hosted Akright City system.</p>

        <ul class="payment-steps">
            <li><span>1</span><div>Confirm the payment is for your ACRA subscription or approved community package.</div></li>
            <li><span>2</span><div>Complete the hosted payment form below, or open it in a separate tab if you prefer.</div></li>
            <li><span>3</span><div>For assistance, contact ACRA at <a href="mailto:info@akrightcity.com" class="font-semibold text-brand-700">info@akrightcity.com</a>.</div></li>
        </ul>

        <div class="mt-8 space-y-3 text-sm text-slate-600">
            <p><strong class="text-brand-900">Office:</strong> Akright City, Entebbe Road</p>
            <p><strong class="text-brand-900">Email:</strong> info@akrightcity.com</p>
            <p><strong class="text-brand-900">Payment portal:</strong> Official hosted Akright City form</p>
        </div>

        <a href="{{ $paymentUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-secondary mt-8">Open Secure Payment Form ↗</a>
    </div>

    <div class="card payment-frame-card" data-reveal>
        <div class="payment-frame-head">
            <div>
                <p class="eyebrow">Official Payment Portal</p>
                <h2>Complete your payment</h2>
            </div>
            <a href="{{ $paymentUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">Open in New Tab ↗</a>
        </div>

        <div class="payment-embed" data-embed-target>
            <button type="button" class="payment-load" data-load-embed data-embed-src="{{ $paymentUrl }}" data-embed-title="ACRA subscription payment form">
                <span class="flex h-16 w-16 items-center justify-center rounded-full bg-brand-600 text-2xl text-white shadow-lg" aria-hidden="true">↗</span>
                <span class="text-xl font-semibold text-brand-900">Load secure payment form</span>
                <span class="max-w-md text-sm text-slate-600">The form loads from the official Akright City payment system. If it does not display in your browser, use the secure new-tab button above.</span>
            </button>
        </div>

        <p class="payment-note">For your security, payments are processed on the official hosted Akright City payment portal. ACRA does not collect card details directly on this website.</p>
    </div>
</section>
@endsection
