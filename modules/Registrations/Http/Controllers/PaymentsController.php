<?php

namespace Modules\Registrations\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Registrations\Repositories\Contracts\IPaymentsRepository;
use Modules\Registrations\Repositories\Contracts\IRegistrationsRepository;
use Modules\Registrations\Http\Requests\PaymentsRequest;

class PaymentsController extends Controller
{

    private $paymentsRepository;

    private $registrationRepository;

    public function __construct(IPaymentsRepository $paymentsRepository, IRegistrationsRepository $registrationsRepository)
    {
        $this->paymentsRepository     = $paymentsRepository;
        $this->registrationRepository = $registrationsRepository;
    }

    public function show($id, $paymentId)
    {
        $payment        = $this->paymentsRepository->fetchById($paymentId);
        $registrationId = $id;

        if($payment) {

            if($payment->status) {
                return abort(404);
            }

            return view('registrations::payment.show', compact('payment', 'registrationId'));

        }

        return abort(404);
    }

    public function doPayment($id, $paymentId, PaymentsRequest $data)
    {
        $registration = $this->registrationRepository->fetchById($id);
        $payment = $this->paymentsRepository->doPayment($paymentId, $data->all());
        $this->registrationRepository->checkIfAllPaymentsWereDone($registration);
        if($payment) {
            return redirect()->route('registrations.show', $id)->with(['success' => 'Pagamento efetuado com sucesso']);
        }
        return back()->withErrors(['Erro ao efetuar pagamento']);
    }

    public function generateChange($paymentId)
    {
        $change = $this->paymentsRepository->generateChange($paymentId);

        if($change) {
            return view('registrations::payment.change', compact('change'));
        }
        return back()->withErrors(['Erro ao gerar troco.']);
    }
}