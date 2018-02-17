<?php

namespace Modules\Registrations\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Registrations\Repositories\Contracts\IPaymentsRepository;
use Modules\Registrations\Http\Requests\PaymentsRequest;

class PaymentsController extends Controller
{

    private $paymentsRepository;

    public function __construct(IPaymentsRepository $paymentsRepository)
    {
        $this->paymentsRepository = $paymentsRepository;
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

    public function doPayment($id, $paymentId, PaymentsRequest$data)
    {
        $payment = $this->paymentsRepository->doPayment($id, $paymentId, $data->all());
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