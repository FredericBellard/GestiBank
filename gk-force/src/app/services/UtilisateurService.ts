import {HttpClient}  from "@angular/common/http";
import {Utilisateur} from "../modeles/Utilisateur";
import {Injectable} from "@angular/core";
import { Observable, throwError } from 'rxjs';
import { catchError, tap, map } from 'rxjs/operators';

@Injectable()
export class UtilisateurService
{
    [x: string]: any;
    private apiUrl='http://localhost/utilisateur?id_user=1';

    constructor(private http: HttpClient){}

    findAll():Observable<Utilisateur[]>
    {
        return this.http.get<Utilisateur[]>(this.apiUrl);
    }



}