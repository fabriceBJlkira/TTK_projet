<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hashids\Hashids;
use Illuminate\Http\Request;
use App\Http\Requests\EquipeRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\RequeteRepository;
use App\Repositories\UsersRepositories;
use App\Http\Requests\ProfilModifRequest;

class HomeController extends Controller
{
    private $userRepositories;
    private $hash;
    private $requeteRepository;

    public function __construct()
    {
        $this->userRepositories = new UsersRepositories();
        $this->requeteRepository = new RequeteRepository();
        $this->hash = new Hashids();
    }

    public function home(Request $request)
    {
        $hash = $this->hash;

        $userProfile = $this->requeteRepository->getUser();

        $users = $this->requeteRepository->firstUser();

        $id = [];
        foreach ($users->groupes as $value) {
            $id [] = $value->id;
        }

        // annonce
        $annonce = $this->requeteRepository->annonceHome($id);

        if (isset($request->logout)) {
            if (session()->has('LoggedUser')) {
                session()->pull('LoggedUser');
                return redirect('');
            }
        } else{

            return view(config('app.home'), [
                'users'=>$userProfile,
                'annonces'=>$annonce,
                'hash' =>$hash
            ]);
        }
    }
    public function joueur()
    {
        $hash = $this->hash;
        $userProfile = $this->requeteRepository->getUser();
        $joueur = $this->requeteRepository->getjoueur(9);
        $equipe = $this->requeteRepository->getEquipe();
        $jeux = $this->requeteRepository->getGameEquipe();
        // recherche joueur
        if (isset($_GET['parnom'])) {
            $joueur = $this->requeteRepository->getjoueurSearch($_GET['parnom'], 9);
            $joueur->withPath('joueur?parnom='.$_GET['parnom']);
        }
        $joueurrech = null;
        // resultat du filtre
        // dd($_GET['parejeux']);
        if (isset($_GET['parequipe']) && isset($_GET['parejeux']) && isset($_GET['parnom'])) {
            $joueurrech = $this->requeteRepository->getjoueurSearchFiltre($hash->decodeHex($_GET['parnom']), $hash->decodeHex($_GET['parequipe']), $hash->decodeHex($_GET['parejeux']));
        }
        return view(config('app.joueur'),[
            'users' => $userProfile,
            'equipes' => $equipe,
            'jeux' => $jeux,
            'joueurs' => $joueur,
            'hash' => $hash,
            'recherche' => $joueurrech
        ]);
    }

    // profile
    public function profil()
    {
        $userProfile = $this->requeteRepository->getUser();
        // dd($userProfile);
        return view(config('app.profil'), [
            'users'=>$userProfile,
        ]);
    }
    public function modificationProfile()
    {
        $userProfile = $this->requeteRepository->getUser();
        $game = $this->requeteRepository->getAllGame();
        $groupe = $this->requeteRepository->getAllUserTeam();
        $hash = $this->hash;
        // dd($groupe);

        return view(config('app.modifierprofile'), [
            'users'=>$userProfile,
            'games'=>$game,
            'groupes'=>$groupe,
            'hash'=>$hash
        ]);
    }
    public function modificationProfilePost(ProfilModifRequest $request)
    {
        $request->validated();
        $this->userRepositories->modifusers($request);
        if (session()->has('fail')) {
            return back()->with('fail', 'Email ou mot de passe incorect');
        }
        return redirect(config('app.profil1'));
    }

    public function modificationgameProfilepost(Request $request, $id)
    {
        $hash = $this->hash;
        $request->validate([
            'jeux'=> 'required',
            'team'  => 'required'
        ]);
        $this->userRepositories->postgame($request, $hash->decodeHex($id));
        return back();
    }

    // team
    public function teams($id)
    {
        $hash = $this->hash;
        $userProfile = $this->requeteRepository->getUser();
        $groupe = $this->requeteRepository->findOrFailTeam($hash->decodeHex($id));
        $pivot = $this->requeteRepository->getPivot($groupe->id);

        // obtension du membre pour le vue equipe et message
        $allMembre = $this->requeteRepository->getAllMembre($groupe->id, $userProfile[0]->id);
        $allMembreOption = $this->requeteRepository->getAllMembre($groupe->id, $userProfile[0]->id);
        // ce code marche
        $allMembreOption->withPath('/team/'.$hash->encodeHex($groupe->id).'?option&addmembre');

        $allMembreEnattente = $this->requeteRepository->getAllMembreEnattente($groupe->id, $userProfile[0]->id);

        // obtension du game
        $game = $this->requeteRepository->getGame($groupe->id);
        // ce code marche
        $game->withPath('/team/'.$hash->encodeHex($groupe->id).'?option&game');

        // systeme de messagerie
        $privateMessage = $this->requeteRepository->getAllMembreMessage($groupe->id, $userProfile[0]->id);
        $message = null;
        if (isset($_GET['to'])) {
            $query = $this->requeteRepository->message();
            $message = $query->paginate(7);

            if ($userProfile[0]->id && $_GET['to']) {
                $this->userRepositories->readAllFrom($query);
            }
            $message->withPath('/team/'.$hash->encodeHex($groupe->id).'?message&to='.$_GET['to']);
        }
        $unread = $this->userRepositories->unreadmessage();

        // annonce
        $annonce = $this->requeteRepository->annonceTeam($groupe->id);
        // ce code marche
        $annonce->withPath('/team/'. $hash->encodeHex($groupe->id).'/?annonce');

        return view(config('app.team'), [
            'users' =>$userProfile,
            'groupes' =>$groupe,
            'pivots' =>$pivot,
            'allmembre' => $allMembre,
            'games' => $game,
            'messages' => $message,
            'unreads' => $unread[0]->count,
            'annonces' => $annonce,
            'hash' => $hash,
            'allMembreEnattente' => $allMembreEnattente,
            'privateMessage' => $privateMessage,
            'allMembreOption' => $allMembreOption
        ]);
    }
    public function teamsCreate()
    {
        $userProfile = $this->requeteRepository->getUser();
        return view('components.createEquipe', [
            'users' =>$userProfile,
        ]);
    }
    public function rechercheTeam(Request $request)
    {
        $userProfile = $this->requeteRepository->getUser();
        $team = $this->requeteRepository->getTeamPaginate(9);
        $pivot = $this->requeteRepository->getPivotSearchTeam();
        // dd($pivot);
        if (isset($request->groupe)) {
            $search = $this->requeteRepository->searchTeam($request);
            return view('components.searchEquipe', [
                'users' =>$userProfile,
                'search'=> $search,
                'pivots'=> $pivot
            ]);
        } else {
            return view('components.searchEquipe', [
                'users' =>$userProfile,
                'teams'=> $team,
                'pivots'=> $pivot
            ]);
        }
    }
    public function adesion(Request $request)
    {
        $this->userRepositories->adesion($request);
        return back();
    }
    public function teamCreatePost(EquipeRequest $request)
    {
        $request->validated();
        $this->userRepositories->createEquipe($request);
        return redirect('home#equipe')->with('cree', 'votre equipe est bien crée admin');
    }

    public function otherprofile($id)
    {
        $hash = new Hashids();
        $userProfile = $this->requeteRepository->getUser();
        $other = User::findOrFail($hash->decodeHex($id));
        return view('components.showprofileother', [
            'users' => $userProfile,
            'others'=> $other,
            'hash'=> $hash
        ]);
    }

    public function posteditotherprofile(Request $request)
    {
        $this->userRepositories->editother($request);
        return back();
    }

    public function leavegroup(Request $request)
    {

        $this->userRepositories->leavegroup($request);
        return redirect('home');
    }

    public function editotherprofile($id)
    {
        $hash = $this->hash;
        $userProfile = $this->requeteRepository->getUser();
        $other = User::findOrFail($hash->decodeHex($id));
        return view('components.editotherprofile', [
            'users' => $userProfile,
            'others'=> $other
        ]);
    }

    public function addmember($id, $id1)
    {
        $hash = $this->hash;
        $this->userRepositories->addmembre($hash->decodeHex($id), $hash->decodeHex($id1));
        return back();
    }

    public function deletemembre($id, $id1)
    {
        $hash = $this->hash;
        $this->userRepositories->deletemembre($hash->decodeHex($id), $hash->decodeHex($id1));
        return back();
    }

    public function modifteamname(Request $requets)
    {
        $this->userRepositories->modifteamname($requets);
        return back()->with('success', 'modification terminer');
    }

    public function modifteamdescription(Request $requets)
    {
        $this->userRepositories->modifteamdescription($requets);
        return back()->with('success', 'modification terminer');
    }

    public function modifteamimage(Request $requets)
    {
        $this->userRepositories->modifteamimage($requets);
        return back()->with('success', 'modification terminer');
    }

    public function deletegamefromgroupe($id, $id2)
    {
        $hash = $this->hash;
        $this->userRepositories->deletegamefromgroupe($hash->decodeHex($id), $hash->decodeHex($id2));
        return back();
    }

    public function coadmin($id, $id1)
    {
        $hash = $this->hash;
        $this->userRepositories->coadmin($hash->decodeHex($id), $hash->decodeHex($id1));
        return back();
    }

    // logout
    public function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('');
        }
    }
}
