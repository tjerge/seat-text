<?PHP

namespace CryptaEve\Seat\Text\Validation;

use Illuminate\Foundation\Http\FormRequest;

class AddPage extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'url' => 'required|alpha_dash|string|unique:crypta_seat_text,url,'.$this->id,
            'text' => 'required|string',
        ];
    }
}

