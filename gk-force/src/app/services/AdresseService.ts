import {HttpClient}  from "@angular/common/http";
import {Adresse} from "../modeles/Adresse";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
export class AdresseService
{
    private apiUrl='http://localhost/adresse?id_adresse=1';

    constructor(private http: HttpClient){}

    findAll():Observable<Adresse[]>
    {
        return this.http.get<Adresse[]>(this.apiUrl);
    }

}