namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use SoftDeletes; // Ativa a data de exclusão automática (Soft Deletes)

    protected $fillable = ['title', 'content', 'user_id'];

    // Esta linha faz o Laravel CRIPTOGRAFAR o conteúdo sozinho antes de salvar no banco!
    protected $casts = [
        'content' => 'encrypted',
    ];

    // Relacionamento: Indica que a nota pertence a um usuário
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
