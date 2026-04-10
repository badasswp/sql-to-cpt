export interface SQLState {
	isLoading: boolean;
	sqlNotice: string;
	parsedSQL: {
		tableName: string;
		tableColumns: string[];
		tableRows: any[];
	};
}

export const DEFAULT_STATE: SQLState = {
	isLoading: false,
	sqlNotice: '',
	parsedSQL: {
		tableName: '',
		tableColumns: [],
		tableRows: [],
	},
};
