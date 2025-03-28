interface TextInputProps {
	name: string;
}

/**
 * TextInput Component.
 *
 * This function returns a JSX component that is
 * a simple input text field.
 *
 * @since 1.0.0
 *
 * @param {Object}         props      - The component props.
 * @param {TextInputProps} props.name - Default Text value.
 *
 * @return {JSX.Element} The TextInput component.
 */
const TextInput = ( { name }: TextInputProps ): JSX.Element => {
	return (
		<p>
			<input type="text" defaultValue={ name } />
		</p>
	);
};

export default TextInput;
