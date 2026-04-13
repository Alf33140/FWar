namespace App\Model;

class Hex {
    public function __construct(
        public readonly int $q,
        public readonly int $r
    ) {}

    public function getS(): int {
        return -$this->q - $this->r;
    }

    // Ajoutez ici plus tard vos méthodes de calcul de distance
}