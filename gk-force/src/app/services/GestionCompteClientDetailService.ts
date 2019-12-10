import {HttpClient}  from "@angular/common/http";
import {GestionCompteClientDetail} from "../modeles/GestionCompteClientDetail";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
export class GestionCompteClientDetailService
{
    private apiUrl='http://localhost/GestionCompteClientDetail?id_client=3';

    constructor(private http: HttpClient){}

    findAll():Observable<GestionCompteClientDetail[]>
    {
        return this.http.get<GestionCompteClientDetail[]>(this.apiUrl);
    }



}

