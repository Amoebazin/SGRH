
<?php
class ClassReserva {
    private $idReserva;
    private $idHospede;
    private $idQuarto;
    private $checkin;
    private $checkout;

    public function getIdReserva() {
        return $this->idReserva;
    }

    public function setIdReserva($idReserva) {
        $this->idReserva = $idReserva;
    }

    public function getIdHospede() {
        return $this->idHospede;
    }

    public function setIdHospede($idHospede) {
        $this->idHospede = $idHospede;
    }

    public function getIdQuarto() {
        return $this->idQuarto;
    }

    public function setIdQuarto($idQuarto) {
        $this->idQuarto = $idQuarto;
    }

    public function getCheckin() {
        return $this->checkin;
    }

    public function setCheckin($checkin) {
        $this->checkin = $checkin;
    }

    public function getCheckout() {
        return $this->checkout;
    }

    public function setCheckout($checkout) {
        $this->checkout = $checkout;
    }
}
