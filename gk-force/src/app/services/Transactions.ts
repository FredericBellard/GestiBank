import {HttpClient}  from "@angular/common/http";
import {Transaction} from "../modeles/Transaction";
import {Observable} from "rxjs";
import {Injectable} from "@angular/core";

@Injectable()
export class TransactionService
{
    private apiUrl='http://localhost/Transaction';

    constructor(private http: HttpClient){}

    findAll():Observable<Transaction[]>
    {
        return this.http.get<Transaction[]>(this.apiUrl);
    }

}