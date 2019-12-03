import {HttpClient}  from "@angular/common/http";
import {Compte} from "../modeles/Compte";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
export class CompteService
{
    private apiUrl='http://localhost/compte';

    constructor(private http: HttpClient){}

    findAll():Observable<Compte[]>
    {
        return this.http.get<Compte[]>(this.apiUrl);
    }

}