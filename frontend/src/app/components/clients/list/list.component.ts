import {Component, Input, OnInit, Output, EventEmitter} from '@angular/core';
import {Client} from "../../../models/Client";

@Component({
  selector: 'app-clients-list',
  templateUrl: './list.component.html',
  styleUrls: ['./list.component.scss']
})
export class ListComponent implements OnInit {
  @Input('clients') clients: Client[];
  @Output() onDelete = new EventEmitter<number>();
  @Output() onEdit = new EventEmitter<number>();

  constructor() { }

  ngOnInit(): void { }

  delete(id) {
    this.onDelete.emit(id);
  }

  edit(id) {
    this.onEdit.emit(id);
  }
}
