<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Google2FA;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Google2FAController extends Controller
{
    public function index()
    {
        $google2fa = app('pragmarx.google2fa');
        $secret = $google2fa->generateSecretKey();
        
        DB::table('users')
            ->where('id', Auth::id())
            ->update(['google2fa_secret' => $secret]);
        
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            Auth::user()->email,
            $secret
        );
        
        // Alterado para usar o caminho correto da view
        return view('auth.2fa.enable', [
            'qrCodeUrl' => $qrCodeUrl,
            'secret' => $secret
        ])->with('layout', 'layouts.guest');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|numeric|digits:6'
        ]);
        
        $google2fa = app('pragmarx.google2fa');
        $user = Auth::user();
        
        $secret = DB::table('users')
            ->where('id', $user->id)
            ->value('google2fa_secret');
            
        $valid = $google2fa->verifyKey($secret, $request->code);
        
        if ($valid) {
            session(['2fa_verified' => true]);
            return redirect()->route('dashboard')->with('success', '2FA ativado com sucesso!');
        }
        
        return back()->withErrors(['code' => 'Código inválido']);
    }
    
    public function verify()
    {
        return view('auth.2fa.verify');
    }
    
    public function validateCode(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|numeric|digits:6'
        ]);
        
        $google2fa = app('pragmarx.google2fa');
        $user = Auth::user();
        
        // Buscar o segredo diretamente do banco
        $secret = DB::table('users')
            ->where('id', $user->id)
            ->value('google2fa_secret');
            
        $valid = $google2fa->verifyKey($secret, $request->code);
        
        if ($valid) {
            session(['2fa_verified' => true]);
            return redirect()->intended('/dashboard')->with('success', 'Verificação bem-sucedida!');
        }
        
        return back()->withErrors(['code' => 'Código inválido']);
    }
}