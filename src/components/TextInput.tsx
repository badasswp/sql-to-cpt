/**
 * TextInput Component.
 *
 * This function returns a JSX component that is
 * a simple input text field.
 *
 * @since 1.0.0
 *
 * @returns {JSX.Element}
 */
const TextInput = ({ name }) => {
  return (
    <p>
      <input type="text" value={name} />
    </p>
  );
}

export default TextInput;
