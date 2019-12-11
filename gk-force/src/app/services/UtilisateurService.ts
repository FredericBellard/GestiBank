import {HttpClient}  from "@angular/common/http";
import {Utilisateur} from "../modeles/Utilisateur";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
export class UtilisateurService
{
    private apiUrl='http://localhost/utilisateur?id_user=1';

    constructor(private http: HttpClient){}

    findAll():Observable<Utilisateur[]>
    {
        return this.http.get<Utilisateur[]>(this.apiUrl);
    }

}