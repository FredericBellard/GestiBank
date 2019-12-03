import {HttpClient}  from "@angular/common/http";
import {Historique} from "../modele/Historique";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
export class HistoriqueService
{
    private apiUrl='http://localhost/historique';

    constructor(private http: HttpClient){}

    findAll():Observable<Historique[]>
    {
        return this.http.get<Historique[]>(this.apiUrl);
    }

}