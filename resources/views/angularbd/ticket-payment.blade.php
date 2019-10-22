@extends('angularbd.sub-layout')
<main class="Meetup__payment">
    @section('content')
        <h4 class="Meetup__sectionTitle">Ticket Price {{ env('EVENT_TICKET_PRICE') }}tk.</h4>
        <p class="Meetup__sectionCopy">Our payment partner aamarPay is an Online Payment Gateway & Merchant Service Provider of Bangladesh. Aiming to provide best payment experience that an estore or customer can expect from a payment processor company.</p>
        <div class="Meetup__suspect">
            <div class="Meetup__suspectCopy">
                <span>Name</span>
                <span>{{ $attendee->name }}</span>
            </div>
            <div class="Meetup__suspectCopy">
                <span>Email</span>
                <span>{{ $attendee->email }}</span>
            </div>
            <div class="Meetup__suspectCopy">
                <span>Phone</span>
                <span>{{ $attendee->mobile }}</span>
            </div>
            <div class="Meetup__suspectCopy">
                <span>Profession</span>
                <span>{{ $attendee->profession }}</span>
            </div>
            <div class="Meetup__suspectCopy">
                <span>Link</span>
                <span>{{ $attendee->social_profile_url }}</span>
            </div>
            <div class="Meetup__suspectCopy">
                <span>T-shirt</span>
                <span>{{ data_get($attendee, 'misc.tshirt') }}</span>
            </div>
            <div class="Meetup__suspectCopy">
                <span>Note</span>
                <span>You wrote nothing.</span>
            </div>
        </div>
    {!!
        aamarpay_post_button([
            'cus_name'  => $attendee->name,
            'cus_email' => $attendee->email,
            'cus_phone' => $attendee->mobile,
            'opt_a' => $attendee->id,
        ], env('EVENT_TICKET_PRICE'), 'Pay 250tk.', 'Button Button--submit')
    !!}
    @endsection
</main>
