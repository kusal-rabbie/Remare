<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\Waiter;
use App\Repositories\ReservationRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ReservationController extends AppBaseController
{
    /** @var  ReservationRepository */
    private $reservationRepository;

    public function __construct(ReservationRepository $reservationRepo)
    {
        $this->reservationRepository = $reservationRepo;
    }

    /**
     * Display a listing of the Reservation.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->reservationRepository->pushCriteria(new RequestCriteria($request));

        if(Auth::user()->authentication == 'customer'){

            $reservations = Reservation::where('customer_id',Auth::user()->id)->get();
        }
        elseif (Auth::user()->authentication == 'manager'){

//            $reservations = $this->reservationRepository->all();
            $reservations = Reservation::where('waiter_id',null)->get();
        }else{

            $reservations = null;
        }


        return view('reservations.index')
            ->with('reservations', $reservations);
    }

    /**
     * Show the form for creating a new Reservation.
     *
     * @return Response
     */
    public function create()
    {
        return view('reservations.create');
    }

    /**
     * Store a newly created Reservation in storage.
     *
     * @param CreateReservationRequest $request
     *
     * @return Response
     */

    public function check(CreateReservationRequest $request){
        $input = $request->all();

        $reservations = Reservation::where('date',$request->date)->get();

        if($reservations == null){

            $tables = Table::all();
        }else{

            $alltables = Table::where('capacity','>', $request['count'] - 1)->get();
//            $alltables = Table::all();

            $tables =[];

            if ($alltables != null){

                foreach ($alltables as $table){

                    array_push($tables,$table);

                    foreach ($reservations as $reservation){

                        $table_id = $reservation->table_id;

                        if($table->id == $table_id){
                            array_pop($tables);
                            break;
                        }else{
                            continue;
                        }
                    }
            }



            }
        }


        return view('reservations.tableLayout')->with(['request' => $input, 'tables' => $tables]);

    }


    public function store(CreateReservationRequest $request)
    {
        $input = $request->all();

        $reservation = $this->reservationRepository->create($input);

        Flash::success('Reservation saved successfully.');

        return redirect(route('reservations.index'));
    }

    /**
     * Display the specified Reservation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $reservation = $this->reservationRepository->findWithoutFail($id);

        if (empty($reservation)) {
            Flash::error('Reservation not found');

            return redirect(route('reservations.index'));
        }

        return view('reservations.show')->with('reservation', $reservation);
    }

    /**
     * Show the form for editing the specified Reservation.
     *
     * @param  int $id
     *
     * @return Response
     */

    public function editTable(UpdateReservationRequest $request){
        $input = $request->all();

        $reservations = Reservation::where('date',$request->date)->get();

        if($reservations == null){

            $tables = Table::all();
        }else{

            $alltables = Table::where('capacity','>', $request['count'] - 1)->get();
//            $alltables = Table::all();

            $tables =[];

            if ($alltables != null){

                foreach ($alltables as $table){

                    array_push($tables,$table);

                    foreach ($reservations as $reservation){

                        $table_id = $reservation->table_id;

                        if($table->id == $table_id){
                            array_pop($tables);
                            break;
                        }else{
                            continue;
                        }
                    }
                }



            }
        }


        return view('reservations.tableLayout')->with(['request' => $input, 'tables' => $tables]);

    }
    public function edit($id)
    {
        $reservation = $this->reservationRepository->findWithoutFail($id);

        if (empty($reservation)) {
            Flash::error('Reservation not found');

            return redirect(route('reservations.index'));
        }

        return view('reservations.edit')->with('reservation', $reservation);
    }

    /**
     * Update the specified Reservation in storage.
     *
     * @param  int              $id
     * @param UpdateReservationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateReservationRequest $request)
    {
        $reservation = $this->reservationRepository->findWithoutFail($id);

        if (empty($reservation)) {
            Flash::error('Reservation not found');

            return redirect(route('reservations.index'));
        }

        $reservation = $this->reservationRepository->update($request->all(), $id);

        Flash::success('Reservation updated successfully.');

        return redirect(route('reservations.index'));
    }

    /**
     * Remove the specified Reservation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $reservation = $this->reservationRepository->findWithoutFail($id);

        if (empty($reservation)) {
            Flash::error('Reservation not found');

            return redirect(route('reservations.index'));
        }

        $this->reservationRepository->delete($id);

        Flash::success('Reservation deleted successfully.');

        return redirect(route('reservations.index'));
    }

    public function review($id){

        return view('reviews.create')->with('id', $id);
    }

    public function assignWaiter($id){

        $reservation = $this->reservationRepository->findWithoutFail($id);

        $reservations = Reservation::where('date',$reservation->date)->where('time',$reservation->time);

        if ($reservations == null) {
            $waiters = Waiter::all();

            return view('reservations.addWaiter')->with(['waiters' => $waiters, 'reservation' => $reservation]);

        }else{

            $allwaiters = Waiter::all();
//            $alltables = Table::all();

            $waiters =[];


                foreach ($allwaiters as $waiter){

                    array_push($waiters,$waiter);

                    foreach ($reservations as $reservation){

                        $waiter_id = $reservation->waiter_id;

                        if($waiter->id == $waiter_id){
                            array_pop($waiter);
                            break;
                        }else{
                            continue;
                        }
                    }
                }

            }



        return view('reservations.addWaiter')->with(['waiters' => $waiters, 'reservation' => $reservation]);

    }

}
