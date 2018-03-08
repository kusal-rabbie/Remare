<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWaiterRequest;
use App\Http\Requests\UpdateWaiterRequest;
use App\Repositories\WaiterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class WaiterController extends AppBaseController
{
    /** @var  WaiterRepository */
    private $waiterRepository;

    public function __construct(WaiterRepository $waiterRepo)
    {
        $this->waiterRepository = $waiterRepo;
    }

    /**
     * Display a listing of the Waiter.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->waiterRepository->pushCriteria(new RequestCriteria($request));
        $waiters = $this->waiterRepository->all();

        return view('waiters.index')
            ->with('waiters', $waiters);
    }

    /**
     * Show the form for creating a new Waiter.
     *
     * @return Response
     */
    public function create()
    {
        return view('waiters.create');
    }

    /**
     * Store a newly created Waiter in storage.
     *
     * @param CreateWaiterRequest $request
     *
     * @return Response
     */
    public function store(CreateWaiterRequest $request)
    {
        $input = $request->all();

        $waiter = $this->waiterRepository->create($input);

        Flash::success('Waiter saved successfully.');

        return redirect(route('waiters.index'));
    }

    /**
     * Display the specified Waiter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $waiter = $this->waiterRepository->findWithoutFail($id);

        if (empty($waiter)) {
            Flash::error('Waiter not found');

            return redirect(route('waiters.index'));
        }

        return view('waiters.show')->with('waiter', $waiter);
    }

    /**
     * Show the form for editing the specified Waiter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $waiter = $this->waiterRepository->findWithoutFail($id);

        if (empty($waiter)) {
            Flash::error('Waiter not found');

            return redirect(route('waiters.index'));
        }

        return view('waiters.edit')->with('waiter', $waiter);
    }

    /**
     * Update the specified Waiter in storage.
     *
     * @param  int              $id
     * @param UpdateWaiterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateWaiterRequest $request)
    {
        $waiter = $this->waiterRepository->findWithoutFail($id);

        if (empty($waiter)) {
            Flash::error('Waiter not found');

            return redirect(route('waiters.index'));
        }

        $waiter = $this->waiterRepository->update($request->all(), $id);

        Flash::success('Waiter updated successfully.');

        return redirect(route('waiters.index'));
    }

    /**
     * Remove the specified Waiter from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $waiter = $this->waiterRepository->findWithoutFail($id);

        if (empty($waiter)) {
            Flash::error('Waiter not found');

            return redirect(route('waiters.index'));
        }

        $this->waiterRepository->delete($id);

        Flash::success('Waiter deleted successfully.');

        return redirect(route('waiters.index'));
    }
}
